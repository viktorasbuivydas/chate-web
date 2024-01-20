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

        setTimeout(() => {
            element.scrollIntoView(options);
        }, 500);
    }

    const scrollToPosition = (element, position) => {
        if (!element) {
            return;
        }

        const top = position || element.scrollHeight - element.clientHeight;
        element.scrollTop = top;
    }

    const isInScrollActionDeadzone = (element, howFarInPixels, callback = {}) => {
        const currentScrollPosition = element.scrollTop + element.clientHeight;

        return currentScrollPosition > element.scrollHeight - howFarInPixels;
    }
    const scrolledSpecifiedAmount = (element, howFarInPixels, callback = {}) => {
        if (isInScrollActionDeadzone(element, howFarInPixels)) {
            callback()
        }
    }

    return {
        scrollToBottom,
        scrollToElement,
        scrollToPosition,
        scrolledSpecifiedAmount,
        isInScrollActionDeadzone
    };
}
