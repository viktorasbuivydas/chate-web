import {computed, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import {useIntersect} from "./useIntersect.js";

export default function useInfiniteScrolling(propName, landmark = null) {
    const value = () => usePage().props[propName];

    const items = ref(value().data);

    const initialUrl = usePage().url;

    const canLoadMoreItems = computed(() => !!value().links.next);
    const loadMoreItems = () => {
        if (!canLoadMoreItems.value) {
            return;
        }

        const { sortAscending } = useSorting();

        router.get(
            value().links.next,
            {},
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                onSuccess: () => {
                    window.history.replaceState({}, "", initialUrl);
                    items.value.splice(0, 0, ...sortAscending(value().data));
                },
            })
    }

    if (landmark !== null) {
        useIntersect(landmark, loadMoreItems, {
            rootMargin: '0px 0px 150px 0px',
        })
    }

    return {
        items,
        loadMoreItems,
        reset: () => items.value = value().data,
        canLoadMoreItems,
    }
}

