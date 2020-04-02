// JavaScript source code

var vue = new Vue({
    el: "#app",
    data: {
        result1: '',
        result2: '',
        result3: '',
        x: 0.13,
        errors: [],
        zarplata: null,
        premia: null,
        koificent: null,
        rabocie: null,
        otrabotanye: null
    },
    methods: {
        checkForm: function (e) {
            if (this.zarplata && this.premia && this.koificent && this.rabocie && this.otrabotanye) {
                return true;
            }
            this.errors = [];

            if (!this.zarplata) {
                this.errors.push(' zapolnite pole 1 ');

            }
            if (!this.premia) {
                this.errors.push(' zapolnite pole 2 ');

            }
            if (!this.koificent) {
                this.errors.push(' zapolnite pole 3 ');

            }
            if (!this.rabocie) {
                this.errors.push(' zapolnite pole 4 ');
                
            }
            if (!this.otrabotanye) {
                this.errors.push(' zapolnite pole 5 ');

            }
            e.preventDefault();
        },

        calc1: function () {
            this.result1 = eval(this.zarplata * this.koificent * (this.otrabotanye / this.rabocie) + eval(this.premia));
            this.result2 = eval(this.result1 * this.x);
            this.result3 = eval(this.result1 - this.result2);
        },
    }
}) 