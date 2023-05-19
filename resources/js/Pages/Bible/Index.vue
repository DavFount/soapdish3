<script setup>
import {Head, Link, router, usePage} from "@inertiajs/vue3";
import MainSection from "@/Components/MainSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import VerseComponent from "@/Components/bible/VerseComponent.vue";
import Button from "@/Components/bible/button.vue";
import {computed, onUpdated, ref, watch} from "vue";

const props = defineProps({
    translations: Object,
    books: Object,
    chapters: Object,
    verses: Object,
    translation_id: Number,
    book_id: Number,
    chapter_id: Number
});

const page = usePage();
const showVersePopup = ref(false);
const translation = ref(props.translation_id ?? page.props.auth.user.translation_id ?? 'Select a translation');
const book = ref(props.book_id ?? 'Select a book');
const chapter = ref(props.chapter_id ?? 'Select a chapter');
const verseContainer = ref(null);
const processing = ref(false);
const bookChange = ref(null);
const manualSelection = ref(false);

onUpdated(() => {
    processing.value = false;

    if (bookChange.value === 1 || (manualSelection.value)) chapter.value = props.chapters[0].id;
    else if (bookChange.value === 0) chapter.value = props.chapters[props.chapters.length - 1].id;

    bookChange.value = null;
    manualSelection.value = false;
})

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

    router.get(route('bible.book', {translation: translation.value, book: newValue}), {}, {
        preserveState: true,
        preserveScroll: false,
    });
    verseContainer.value.scrollTop = 0;
    chapter.value = 'Select a chapter';
});

watch(chapter, (newValue) => {
    if (newValue === 'Select a chapter' || processing.value) return;

    processing.value = true;
    router.get(route('bible.chapter', {translation: translation.value, book: book.value, chapter: newValue}), {}, {
        preserveState: true,
        preserveScroll: false,
    });
    verseContainer.value.scrollTop = 0;
});

watch(translation, (newValue) => {
    if (processing.value) return;

    if (book.value !== 'Select a book' && chapter.value !== 'Select a chapter') {
        processing.value = true;
        router.get(route('bible.chapter', {translation: translation.value, book: book.value, chapter: chapter.value}), {}, {
            preserveState: true,
            preserveScroll: false,
        });
        verseContainer.value.scrollTop = 0;
    }
});

const previousBook = () => {
    if (!firstBook || processing.value) return;
    console.log('Prev Book Pressed');
    book.value--;
}

const nextBook = () => {
    if (!lastBook || processing.value) return;
    console.log('Next Book Pressed');
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

</script>

<template>
    <Head title="Bible"/>
    <MainSection>
        <template #header v-if="props.books.length">
            <div class="flex gap-1 items-center">

                <div>
                    <InputLabel for="translation" value="Translation" class="sr-only"/>
                    <select
                        v-model="translation"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        <option disabled>Select a translation</option>
                        <option v-for="t in $props.translations" :key="t.id" :value="t.id">{{ t.abbreviation }}</option>
                    </select>
                </div>

                <div v-if="translation !== 'Select a translation'">
                    <InputLabel for="book" value="Book" class="sr-only"/>
                    <select
                        @change="manualSelection = true"
                        v-model="book"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        <option disabled>Select a book</option>
                        <option v-for="b in $props.books" :key="b.id" :value="b.id">{{ b.name }}</option>
                    </select>
                </div>

                <div v-if="book !== 'Select a book'">
                    <InputLabel for="chapter" value="Book" class="sr-only"/>
                    <select
                        v-model="chapter"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                        <option disabled>Select a chapter</option>
                        <option v-for="c in $props.chapters" :key="c.id" :value="c.id">
                            {{ c.number }}
                        </option>
                    </select>
                </div>
            </div>

        </template>

        <div v-if="translation === 'Select a translation'">
            Please head to your
            <Link :href="route('profile.show')" v-text="'Profile'" class="text-blue-500 hover:underline"/>
            and set your preferred Bible translation, or select one above.
        </div>

        <div ref="verseContainer" class="container overflow-y-scroll" v-else>
            <VerseComponent @click="showVersePopup = true" class="verse" v-for="verse in props.verses" :key="verse.id"
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
