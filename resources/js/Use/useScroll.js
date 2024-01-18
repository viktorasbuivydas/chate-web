export default function useScroll() {
    const scrollToBottom = (element) => {
        if (!element) {
            return;
        }
        element.scrollTop = element.scrollHeight;
    };

    const scrollToElement = (element, options = {}) => {
        if (!element) {
            return;
        }

        element.scrollIntoView(options);
    }

    const scrollToPosition = (element, position) => {
        if (!element) {
            return;
        }

        const top = position || element.scrollHeight - element.clientHeight;
        element.scrollTop = top;
    }

    return {
        scrollToBottom,
        scrollToElement,
        scrollToPosition,
    };
}
