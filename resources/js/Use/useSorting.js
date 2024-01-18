export default function useSorting() {
    const sortAscending = (messages) => {
        return messages.sort((a, b) => {
            return a.id - b.id;
        });
    };

    return {
        sortAscending
    };
}
