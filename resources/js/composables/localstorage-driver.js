import {computed, ref} from "vue";

const useLocalstorageDriver = (initVal, identifier) => {
    const internal = ref();

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
