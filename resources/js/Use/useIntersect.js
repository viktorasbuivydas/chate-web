export default function useIntersect (element, callback, options = {}) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                callback();
            }
        });
    }, options);

    observer.observe(element);

    return {
        observer,
    };
}
