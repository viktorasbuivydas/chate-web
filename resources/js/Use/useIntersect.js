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
        try {
            observer.observe(element.value);
        } catch (e) {
            console.error('Cant observe element', e);
        }
    });

    onUnmounted(() => {
        observer.disconnect();
    });

    return {
        observer,
    };
}
