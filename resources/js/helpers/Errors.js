export default class Errors {
    constructor() {
        this.list = [];
        this.message = null;
    }

    has(field) {
        return this.list.hasOwnProperty(field);
    }

    any() {
        return Object.keys(this.list).length > 0;
    }

    get(field) {
        if (this.list[field]) {
            return this.list[field][0];
        }
    }

    errorMessage() {
        return this.message;
    }

    fill(data) {
        this.list = data.errors;
        this.message = data.message;
    }

    clear(field) {
        delete this.list[field];
        delete this.message;
    }

    reset() {
        this.list = {};
    }
}
