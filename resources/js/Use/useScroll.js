const useScroll = () => {
    const scrollToBottom = (element) => {
        if (element) {
            element.scrollTop = element.scrollHeight;
        }
    };

    return {
        scrollToBottom,
    };
};

export default useScroll;
