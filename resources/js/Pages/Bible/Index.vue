<script setup>
import {Head, Link, router, usePage} from "@inertiajs/vue3";
import MainSection from "@/Components/MainSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import VerseComponent from "@/Components/bible/VerseComponent.vue";
import VerseSelectionMenu from "@/Components/bible/VerseSelectionMenu.vue";
import Button from "@/Components/bible/button.vue";
import {computed, ref, watch} from "vue";

const props = defineProps({
    translations: Array,
    books: Array,
    chapters: Array,
    verses: Array,
    saved_verses: Array,
    translation_id: Number,
    book_id: Number,
    chapter_id: Number
});

const page = usePage();
const translation = ref(props.translation_id ?? page.props.auth.user.translation_id ?? 'Select a translation');
const book = ref(props.book_id ?? 'Select a book');
const chapter = ref(props.chapter_id ?? 'Select a chapter');
const verseContainer = ref(null);
const processing = ref(false);
const bookChange = ref(null);
const manualSelection = ref(false);

const debug = () => {
    return {
        isProcessing: processing.value,
        bookChangingVal: bookChange.value,
        curTranslation: translation.value,
        curBook: book.value,
        curChapter: chapter.value,
        manualSelectionVal: manualSelection.value,
        allTranslations: props.translations,
        allBooks: props.books,
        allChapters: props.chapters,
        allVerses: props.verses,
    }
}

const firstChapter = computed(() => {
    return props.chapters && chapter.value === props.chapters[0].id;
});

const lastChapter = computed(() => {
    return props.chapters && chapter.value === props.chapters[props.chapters.length - 1].id;
});

const firstBook = computed(() => {
    return props.books && book.value === props.books[0].id;
});

const lastBook = computed(() => {
    return props.books && book.value === props.books[props.books.length - 1].id;
});

watch(book, (newValue, oldValue) => {
    if (newValue === null || processing.value) return;

    processing.value = true;
    if (newValue > oldValue) bookChange.value = 1; else bookChange.value = 0;


    selectedVerses.value = [];
    verseContainer.value.scrollTop = 0;

    router.visit(route('bible', {translation: translation.value, book: newValue}), {
        only: ['books', 'book_id', 'translation_id', 'chapters'],
        onSuccess: (page) => {
            processing.value = false;

            processBookChange(page.props.chapters);
        }
    });
});

const processBookChange = (chapters) => {
    if ((bookChange.value === 1 || (manualSelection.value))) chapter.value = page.props.chapters[0].id;
    else if (bookChange.value === 0) chapter.value = page.props.chapters[page.props.chapters.length - 1].id;
    bookChange.value = null;
    manualSelection.value = false;

    loadChapter(chapter.value);
}

watch(chapter, (newValue) => {

    if (newValue === 'Select a chapter' || processing.value) return;

    selectedVerses.value = [];
    processing.value = true;
    verseContainer.value.scrollTop = 0;

    loadChapter(newValue);
});

const loadChapter = (chapter) => {
    router.visit(route('bible', {translation: translation.value, book: book.value, chapter: chapter}), {
        only: ['chapters', 'verses', 'chapter', 'chapter_id'],
        onSuccess: (page) => {
            processing.value = false;
        }
    });
}

watch(translation, (newValue) => {
    if (processing.value) return;

    selectedVerses.value = [];
    if (book.value !== 'Select a book' && chapter.value !== 'Select a chapter') {
        processing.value = true;
        router.visit(route('bible', {
            translation: translation.value,
            book: book.value,
            chapter: chapter.value
        }), {
            only: ['translation_id', 'verses']
        });
    }
});

const previousBook = () => {
    if (!firstBook || processing.value) return;
    book.value--;
}

const nextBook = () => {
    if (!lastBook || processing.value) return;
    book.value++;
}

const previousChapter = () => {
    if (processing.value) return;
    chapter.value--;
}

const nextChapter = () => {
    if (processing.value) return;
    chapter.value++;
}

const selectedVerses = ref([]);
const selectVerse = (verseId) => {
    if (!selectedVerses.value.includes(verseId)) {
        selectedVerses.value.push(verseId);
    } else {
        selectedVerses.value = selectedVerses.value.filter((id) => {
            return id !== verseId;
        });
    }
}

const versesSelected = computed(() => {
    return selectedVerses.value.length;
});

const isSelected = (id) => {
    return selectedVerses.value.includes(id)
}

const isUnderlined = (id) => {
    const newVerse = props.saved_verses.filter(v => {
        return v.id === id;
    });

    if (newVerse.length) {
        return newVerse[0].pivot.underline;
    }
    return '';
}

const isHighlighted = (id) => {
    const newVerse = props.saved_verses.filter(v => {
        return v.id === id;
    });

    if (newVerse.length) {
        return newVerse[0].pivot.highlight;
    }
    return '';
}

const saveVerses = (e) => {
    router.post(route('bible.save-verse', {
        translation: translation.value,
        book: book.value,
        chapter: chapter.value,
    }), {
        selectedVerses: selectedVerses.value,
        highlight: e.styleHighlight,
        underline: e.styleUnderline,
    }, {
        preserveScroll: true,
        preserveState: true,
    });

    selectedVerses.value = [];
}

const textSize = ref(2);
const decreaseTextSize = () => {
    if (textSize.value > 1) {
        textSize.value--
    }
}

const increaseTextSize = () => {
    if (textSize.value < 5) {
        textSize.value++
    }
}

</script>

<template>
    <Head title="Bible"/>
    <MainSection>
        <template #header v-if="props.books.length">
            <div class="block sm:flex justify-between">
                <div>
                    <div class="block sm:flex gap-1 items-center">

                        <div>
                            <InputLabel for="translation" value="Translation" class="sr-only"/>
                            <select
                                v-model="translation"
                                class="w-full sm:w-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                                <option disabled>Select a translation</option>
                                <option v-for="t in $props.translations" :key="t.id" :value="t.id">{{
                                        t.abbreviation
                                    }}
                                </option>
                            </select>
                        </div>

                        <div v-if="translation !== 'Select a translation'" class="mt-3 sm:mt-0">
                            <InputLabel for="book" value="Book" class="sr-only"/>
                            <select
                                @change="manualSelection = true"
                                v-model="book"
                                class="w-full sm:w-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                                <option disabled>Select a book</option>
                                <option v-for="b in $props.books" :key="b.id" :value="b.id">{{ b.name }}</option>
                            </select>
                        </div>

                        <div v-if="book !== 'Select a book'" class="mt-3 sm:mt-0">
                            <InputLabel for="chapter" value="Book" class="sr-only"/>
                            <select
                                v-model="chapter"
                                class="w-full sm:w-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                                <option disabled>Select a chapter</option>
                                <option v-for="c in $props.chapters" :key="c.id" :value="c.id">
                                    {{ c.number }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3 sm:mt-0 flex align-bottom items-end gap-x-8">
                    <button
                        @click="decreaseTextSize"
                        class="py-0.5 px-1 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                        <svg class="w-6 h-6 fill-gray-600 dark:fill-gray-300" viewBox="0 0 76 76"
                             xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-opacity="1" stroke-linejoin="round"
                                      d="M 45,25L 59,25L 59,29L 45,29L 45,25 Z M 52.1429,56L 45.4571,56L 42.283,46.7429L 28.4375,46.7429L 25.4,56L 18.7143,56L 32.1339,20L 38.8277,20L 52.1429,56 Z M 40.7402,42.1143L 35.8464,27.417C 35.7018,26.9455 35.5464,26.1875 35.3804,25.1429L 35.2759,25.1429C 35.1313,26.1018 34.9679,26.8598 34.7857,27.417L 29.9563,42.1143L 40.7402,42.1143 Z "></path>
                            </g>
                        </svg>
                    </button>

                    <button
                        @click="increaseTextSize"
                        class="py-0.5 px-1 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                        <svg class="w-6 h-6 fill-gray-600 dark:fill-gray-300" viewBox="0 0 76 76"
                             xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-opacity="1" stroke-width="0.2"
                                      stroke-linejoin="round"
                                      d="M 45.0001,25L 50,25L 50,20L 54,20L 54,25L 59.0001,25L 59.0001,29L 54,29L 54,34L 50,34L 50,29L 45.0001,29L 45.0001,25 Z M 52.1429,56L 45.4571,56L 42.283,46.7429L 28.4375,46.7429L 25.4,56L 18.7143,56L 32.1339,20L 38.8277,20L 52.1429,56 Z M 40.7402,42.1143L 35.8464,27.417C 35.7018,26.9455 35.5464,26.1875 35.3804,25.1429L 35.2759,25.1429C 35.1313,26.1018 34.9679,26.8598 34.7857,27.417L 29.9563,42.1143L 40.7402,42.1143 Z "></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>


        </template>

        <div v-if="translation === 'Select a translation'">
            Please head to your
            <Link :href="route('profile.show')" v-text="'Profile'" class="text-blue-500 hover:underline"/>
            and set your preferred Bible translation, or select one above.
        </div>

        <div ref="verseContainer" class="container overflow-y-scroll grid grid-cols-1 gap-6" v-else>
            <VerseComponent @selected="selectVerse" class="verse cursor-pointer" v-for="verse in props.verses"
                            :key="verse.id" :textSize="textSize"
                            :verseId="verse.id" :selected="isSelected(verse.id)"
                            :highlight="isHighlighted(verse.id)" :underline="isUnderlined(verse.id)"
                            v-if="props.verses"
                            :number="verse.number">
                {{ verse.text }}
            </VerseComponent>
        </div>

        <div class="mt-6 flex justify-between" v-if="props.verses">
            <Button @click="previousBook" v-if="firstChapter" :disabled="firstBook">Previous Book</Button>
            <Button @click="previousChapter" v-else>Previous Chapter</Button>

            <Button @click="nextBook" v-if="lastChapter" :disabled="lastBook">Next Book</Button>
            <Button @click="nextChapter" v-else>Next Chapter</Button>
        </div>
    </MainSection>
    <VerseSelectionMenu
        @saveVerses="saveVerses"
        @cancelSaveVerse="selectedVerses = []"
        :selectedVerses="selectedVerses"
        v-if="selectedVerses.length"
    />
</template>

<style scoped>
.container {
    height: 65vh;
}
</style>

<script>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

export default {
    layout: DefaultLayout,
}
</script>
