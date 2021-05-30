<template>
<div>
    <div class="container max-height is-max-widescreen is-flex is-align-items-center is-justify-content-center">
        <div class="card p-5 mx-3">
            <section class="p-6">
                <h1 class="title">Inserisci il codice</h1>
                <br>
                <form>
                    <b-field label="Name" v-bind:type="error ? 'is-danger' : ''">
                        <b-input placeholder="Username" v-model="user" type="Username" icon="account" icon-clickable>
                        </b-input>
                    </b-field>
                    <br>
                    <b-field label="Password" v-bind:type="error ? 'is-danger' : ''">
                        <b-input type="password" placeholder="Password" v-model="psw" @icon-click="form-textbox-password" password-reveal>
                        </b-input>
                    </b-field>
                </form>
                <br>
                <div class="buttons">
                    <b-button :loading="this.querying" v-on:click="login()" v-bind:type="error ? 'is-danger' : 'is-success'" v-bind:icon-left="success ? 'check-all' : 'login-variant' " expanded>Continua</b-button>
                </div>
                <div class="buttons">
                    <b-button :loading="this.querying" v-on:click="creaBiglietto()" v-bind:type="error ? 'is-danger' : 'is-warning'" v-bind:icon-left="success ? 'check-all' : 'ticket-confirmation' " expanded>Genera Biglietto</b-button>
                </div>
                <div class="buttons">
                    <b-button v-if="biglietto" v-on:click="alertCustom()" type="is-primary" icon-left="eye" expanded>Riapri Credenziali Biglietto</b-button>
                </div>
                <div class="buttons">
                    <b-button v-on:click="prendidati()" type="is-info" icon-left="graph" expanded>Stampa dati biglietto</b-button>
                </div>
                <b-select v-model="data">
                <optgroup label="Scegli l'anno">
                    <option v-for="anno in anni" :key="anno" :value="anno">{{anno}}</option>
                </optgroup>
                </b-select>
            </section>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios"

export default ({
    data: () => ({
        success: false,
        error: false,
        querying: false,
        user: null,
        psw: null,
        biglietto: null,
        reportdatibiglietti: null,
        data: 2021,
        anni: Array.of("tutti gli anni",2021,2022,2022,2023,2024),
    }),

    methods: {
        login() {
            this.querying = true;
            var data = {
                "username": this.user,
                "password": this.psw
            };

            axios.post(`/login_check`, data)
                .then(response => {
                    this.querying = false;
                    this.data = response.data;
                    this.error = false;
                    this.success = true;
                    window.location.href = "/"
                })
                .catch(() => {
                    this.error = true;
                    this.querying = false;
                    this.danger();
                })
        },

        creaBiglietto() {
            this.querying = true;

            axios.post(`/login/creabiglietto`)
                .then(response => {
                    this.querying = false;
                    this.biglietto = response.data;
                    this.error = false;
                    this.success = true;
                    this.alertCustom();
                })
                .catch(() => {
                    this.error = true;
                    this.querying = false;
                })
        },

        alertCustom() {
            this.$buefy.dialog.alert({
                title: 'Credenziali Biglietto',
                message: 'user: ' + this.biglietto.user +
                    '<br> psw: ' + this.biglietto.psw +
                    '<br> tipo giro: ' + this.biglietto.tipo_giro +
                    '<br> data: ' + new Intl.DateTimeFormat('it-IT').format(new Date()),
                confirmText: 'Ho letto'
            })
        },

        danger() {
            this.$buefy.snackbar.open({
                duration: 3000,
                message: 'Utente o Password errati! <em>Riprova<em>',
                type: 'is-danger',
                position: 'is-bottom-left',
                actionText: 'Ritenta',
                queue: false
            })
        },

        prendidati() {
            this.querying = true;
            if (this.data == "tutti gli anni"){
                this.data = null;
            }
            var data = {
                "data": this.data,
            };

            axios.post(`/login/dati`, data)
                .then(response => {
                    this.querying = false;
                    this.error = false;
                    this.success = true;
                    this.reportdatibiglietti = [];
                    response.data.forEach(dato=>{
                        this.reportdatibiglietti.push(Array.of(dato["id"],dato["username"],dato["tipo_giro"],dato["data_biglietto"]));
                    })
                    console.log(this.reportdatibiglietti);
                    this.exportToCsv("dati.csv",this.reportdatibiglietti);
                })
                .catch(() => {
                    this.error = true;
                    this.querying = false;
                })
        },

        exportToCsv(filename, rows) {
            var processRow = function (row) {
                var finalVal = '';
                for (var j = 0; j < row.length; j++) {
                    var innerValue = row[j] === null ? '' : row[j].toString();
                    if (row[j] instanceof Date) {
                        innerValue = row[j].toLocaleString();
                    };
                    var result = innerValue.replace(/"/g, '""');
                    if (result.search(/("|,|\n)/g) >= 0)
                        result = '"' + result + '"';
                    if (j > 0)
                        finalVal += ';';
                    finalVal += result;
                }
                return finalVal + '\n';
            };

            var csvFile = '';
            for (var i = 0; i < rows.length; i++) {
                csvFile += processRow(rows[i]);
            }

            var blob = new Blob([csvFile], {
                type: 'text/csv;charset=utf-8;'
            });
            if (navigator.msSaveBlob) { // IE 10+
                navigator.msSaveBlob(blob, filename);
            } else {
                var link = document.createElement("a");
                if (link.download !== undefined) { // feature detection
                    // Browsers that support HTML5 download attribute
                    var url = URL.createObjectURL(blob);
                    link.setAttribute("href", url);
                    link.setAttribute("download", filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }
        },
    }
})
</script>

<style scoped>
.max-height {
    height: 100vh
}

.logo {
    width: 100px
}

@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
</style>
