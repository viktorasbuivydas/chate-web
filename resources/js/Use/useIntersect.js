import {onMounted, onUnmounted} from "vue";

export default function useIntersect (element, callback = () => {}, options = {}) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                callback();
            }
        });
    }, options);


    onMounted(() => {
        observer.observe(element.value);
    });

    onUnmounted(() => {
        observer.disconnect();
    });

    return {
        observer,
    };
}
