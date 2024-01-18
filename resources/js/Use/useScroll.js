export default function useScroll() {
    const scrollToBottom = (element) => {
        if (element) {
            element.scrollTop = element.scrollHeight;
        }
    };

    const scrollToElement = (element, options = {}) => {
        if (element) {
            element.scrollIntoView(options);
        }
    }

    return {
        scrollToBottom,
        scrollToElement
    };
}
