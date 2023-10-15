const useToast = () => {
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

export default useToast;
