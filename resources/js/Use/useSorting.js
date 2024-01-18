export default function useSorting() {
    const sortAscending = (items) => {
        return items.sort((a, b) => {
            return a.id - b.id;
        });
    };

    return {
        sortAscending
    };
}
