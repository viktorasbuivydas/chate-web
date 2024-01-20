import {computed, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import useIntersect from "./useIntersect.js";
import useSorting from "./useSorting.js";
import useScroll from "@/Use/useScroll.js";

export default function useInfiniteScrolling(propName, landmark = null, callback = () => {
}) {
    const {sortAscending} = useSorting();
    const {scrollToElement} = useScroll();

    const isLoading = ref(false);

    const lastItemElement = ref(null)
    const value = () => usePage().props[propName];

    const items = ref(sortAscending(value().data));

    const initialUrl = usePage().url;

    const canLoadMoreItems = computed(() => !!value().next_page_url);

    const firstItemBasedOnCurrentPage = computed(() => {
        const currentPage = value().current_page;
        const perPage = value().per_page;
        // calculate the first item based on the current page
        return (currentPage - 1) * (perPage) + 1;
    });
    const loadMoreItems = async () => {
        if (!canLoadMoreItems.value) {
            return;
        }

        isLoading.value = true;

        setTimeout(async () => {
            await router.get(
                value().next_page_url,
                {},
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                    onSuccess: () => {
                        window.history.replaceState({}, "", initialUrl);
                        // sorting new items and adding them to the beginning of the list
                        items.value.splice(0, 0, ...sortAscending(value().data));

                        callback();
                    },
                    onFinish: () => {
                        isLoading.value = false;
                    }
                })


            setTimeout(() => {
                lastItemElement.value = document.getElementById('message-' + firstItemBasedOnCurrentPage.value);
                scrollToElement(lastItemElement.value, {block: 'end', behavior: 'smooth'});
            }, 100)
        }, 1000);
    }

    if (landmark !== null) {
        useIntersect(landmark, loadMoreItems)
    }

    return {
        items,
        loadMoreItems,
        reset: () => items.value = value().data,
        canLoadMoreItems,
        isLoading,
    }
}

