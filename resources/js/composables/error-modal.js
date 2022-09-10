import emitter from "../emitter";
import useAuthStore from "../store/auth.store";
import {useRouter} from "vue-router";

const useErrorModal = () => {
    const processServerError = (err) => {
        try {
            const response = err.response;

            switch (response.status) {
                case 422:
                    processServerValidationException(response);
                    break;
                case 401:
                    processUnauthorizedServerException();
                    break;
                case 403:
                    showModal("Brak permisji!");
                    break;
                default:
                    showModal("Wystąpił błąd serwera. Jeżeli sytuacja się powtarza, skontaktuj się z administratorem (zakładka kontakt).");
            }
        } catch (e) {
            console.error(err, e);
            showModal("Wystąpił nieznany błąd. Jeżeli sytuacja się powtarza, skontaktuj się z administratorem (zakładka kontakt).");
        }
    }

    const processUnauthorizedServerException = () => {
        showModal("Serwer mówi, że nie jesteś zalogowany. Spróbuj zalogować się jeszcze raz.");

        const store = useAuthStore();
        const router = useRouter();
        store.token.value = undefined;
        store.user.value = null;
        router.push("/auth/login");
    }

    const processServerValidationException = (response) => {
        let errors = "";

        for (const index in response.data) {
            errors += response.data[index] + "<br />";
        }

        showModal(errors);
    }

    const showModal = (text) => {
        emitter.emit("error:modal:show", text)
    }

    const hideModal = () => {
        emitter.emit("error:modal:hide")
    }

    return {showModal, hideModal, processServerError};
}

export default useErrorModal;
