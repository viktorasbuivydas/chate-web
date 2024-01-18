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
    const loadMoreItems = async () => {
        if (!canLoadMoreItems.value) {
            return;
        }

        isLoading.value = true;

        const chat = document.querySelector("#chat");

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
                        const data = sortAscending(value().data);
                        items.value.splice(0, 0, ...data);

                        callback();
                    },
                    onFinish: () => {
                        isLoading.value = false;
                    }
                })

            lastItemElement.value = document.getElementById('message-' + value().data[value().data.length-1].id);
            scrollToElement(lastItemElement.value, {block: 'end', behavior: 'smooth'});
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

