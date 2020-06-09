import { ToastProgrammatic as Toast } from 'buefy';

export default class Messenger {
    static primary(message) {
        Toast.open({
            message,
            type: "is-primary"
        });
    }

    static info(message) {
        Toast.open({
            message,
            type: 'is-info'
        });
    }

    static success(message) {
        Toast.open({
            message,
            type: 'is-success'
        });
    }

    static warning(message) {
        Toast.open({
            message,
            type: 'is-warning'
        });
    }

    static error(message) {
        Toast.open({
            message,
            type: 'is-danger'
        });
    }
}
