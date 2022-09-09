import {computed, ref} from "vue";

const useLocalstorageDriver = (identifier) => {
    const internal = ref(localStorage.getItem(identifier));

    return computed({
        get: () => internal.value,
        set: (val) => {
            if (val === null || val === undefined) {
                localStorage.removeItem(identifier);
            } else {
                localStorage.setItem(identifier, val);
            }
            internal.value = val;
        }
    });
}

export default useLocalstorageDriver;
