export default function useArray() {
    const lastItem = (arr) => arr[arr.length - 1];

    return {
        lastItem
    }
}
