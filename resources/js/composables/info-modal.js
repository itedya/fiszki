import emitter from "../emitter";

const useInfoModal = () => {
    const showModal = (title, text) => {
        emitter.emit("info:modal:show", {title, text})
    }

    const hideModal = () => {
        emitter.emit("info:modal:hide")
    }

    return {showModal, hideModal};
}

export default useInfoModal;
