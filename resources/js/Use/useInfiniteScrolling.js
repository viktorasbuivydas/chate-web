import {computed, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import useIntersect from "./useIntersect.js";
import useSorting from "./useSorting.js";

export default function useInfiniteScrolling(propName, landmark = null, callback = () => {
}) {
    const {sortAscending} = useSorting();

    const value = () => usePage().props[propName];

    const items = ref(sortAscending(value().data));

    const lastFetchedItem = ref(items.value[items.value.length - 1]);

    const initialUrl = usePage().url;

    const canLoadMoreItems = computed(() => !!value().next_page_url);
    const loadMoreItems = () => {
        if (!canLoadMoreItems.value) {
            return;
        }

        router.get(
            value().next_page_url,
            {},
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                onSuccess: () => {
                    window.history.replaceState({}, "", initialUrl);
                    const data = sortAscending(value().data);
                    items.value.splice(0, 0, ...data);

                    //scrollToElement(lastFetchedItem.value);

                    callback();
                },
            })
    }

    if (landmark !== null) {
        useIntersect(landmark, loadMoreItems)
    }

    return {
        items,
        loadMoreItems,
        reset: () => items.value = value().data,
        canLoadMoreItems,
        // lastFetchedItem,
    }
}

