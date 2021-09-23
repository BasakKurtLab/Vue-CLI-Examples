<template>
    <div class="container wrapper">
        
        <div v-if="schritt==1">
            <h2>Anmelden</h2>

            <div class="loginContainer">
                <input placeholder="Benutzername" id="bn" v-model="bname">
                <input placeholder="Passwort" id="pw" type="password" v-model="pass">
                <button @click="login">Anmelden</button>
                <div :class="meldung_class">
                    {{ meldung }}
                </div>
            </div>
        </div>

        <div v-else-if="schritt==2">
            Herzlich Willkommen {{ vorname }}!

            <div class="produkte">
                <button @click="hinzufugen('iPhone 5', 300)">iPhone 5 - 300€</button>
                <button @click="hinzufugen('iPhone 6', 400)">iPhone 6 - 400€</button>
                <button @click="hinzufugen('iPhone 7', 500)">iPhone 7 - 500€</button>
            </div>
            
            <div class="warenkorb">
                <h3>Warenkorb</h3>
                <ul>
                    <li v-for="p in warenkorb" :key="p">
                        {{p.name}} - {{p.preis}}
                    </li>
                </ul>
            </div>
        </div>

    </div>
</template>

<script>

import Cookies from "js-cookie";

export default {
    
    created()
    {
        if(Cookies.get("logged_in") == "1")
        {
            this.schritt = 2;

            if(Cookies.get("warenkorb"))
            {
                const liste = JSON.parse(Cookies.get("warenkorb"));
                
                for(let p of liste)
                {
                    this.warenkorb.push(p);
                }
            }
        }
    },
    mounted()
    {
        if(this.schritt == 1)
        {
            document.getElementById("bn").focus();
        }
    },
    data()
    {
        return {
            bname: "",
            pass: "",
            schritt: 1,
            vorname: "",
            meldung: "Ungültige Anmeldedaten! Bitte versuchen Sie erneut.",
            meldung_class: "meldung versteckt",
            warenkorb: []
        }
    },
    methods:
    {
        login()
        {
            if(this.bname == "admin" && this.pass == "123")
            {
                Cookies.set("logged_in", "1");
                this.schritt = 2;
            }
            else
            {
                // Fehlermeldung
                this.meldung_class = "meldung";
                this.pass = "";
                document.getElementById("pw").focus();

                setTimeout(() => { this.meldung_class = "meldung versteckt" }, 4000)

                // FALSCH! Scope ist nicht beim Application, sondern beim "window" Objekt
                // setTimeout( function() { this.meldung_class = "meldung versteckt" }, 4000)
            }
        },
        hinzufugen(produktname, preis)
        {
            this.warenkorb.push({ name:produktname, preis:preis })

            Cookies.set("warenkorb", JSON.stringify(this.warenkorb));
        }
    }

}


</script>



<style scoped>
    
    .container
    {
        padding: 80px;
    }
    .container h2
    {
        margin: 0 0 15px 0;
    }


    .loginContainer
    {
        width: 350px;
        display: flex;
        flex-direction: column;
        margin: 0 auto;
        position: relative;
    }
    .loginContainer>input
    {
        margin-bottom: 15px;
        padding: 8px 12px;
        border: none;
        border-bottom: 1px solid #aaa;
        outline: none;
    }
    .loginContainer>button
    {
        margin-top: 10px;
        border: none;
        padding: 12px;
        outline: none;
        background-color: crimson;
        font-weight: bold;
        color: white;
        cursor: pointer;
        border-radius: 8px;
    }
    .loginContainer>button:hover
    {
        background-color: rgb(199, 21, 57);
    }

    .meldung
    {
        background-color: white;
        border-radius: 8px;
        padding: 12px;
        -webkit-box-shadow: 0px 0px 14px 3px rgba(0,0,0,0.15); 
        box-shadow: 0px 0px 14px 3px rgba(0,0,0,0.15);
        font-size: 0.8em;

        position: absolute;
        bottom: -90px;
        opacity: 1;

        transition: opacity 0.5s;
        border-left: 11px solid rgb(187, 0, 0);
    }
        
    .meldung.versteckt
    {
        opacity: 0;
    }

</style>