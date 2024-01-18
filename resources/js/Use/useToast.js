export default function useToast() {
    const toast = (message, type) => {
        window.toast.fire({
            icon: type,
            title: message
        })
    }

    return {
        toast
    }
}
