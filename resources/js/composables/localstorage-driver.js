import {computed, ref} from "vue";

const useLocalstorageDriver = (identifier, parseJson = false) => {
    const internal = ref();

    if (parseJson) {
        internal.value = JSON.parse(localStorage.getItem(identifier));
    } else {
        internal.value = localStorage.getItem(identifier);
    }

    return computed({
        get: () => internal.value,
        set: (val) => {
            if (val === null || val === undefined) {
                localStorage.removeItem(identifier);
            } else {
                if (parseJson) {
                    localStorage.setItem(identifier, JSON.stringify(val));
                } else {
                    localStorage.setItem(identifier, val);
                }
            }

            internal.value = val;
        }
    });
}

export default useLocalstorageDriver;
