<template>
    <div class="container wrapper">
        
        <div v-if="schritt==1">
            <h2>Anmelden</h2>

            <div class="loginContainer">
                <input placeholder="Benutzername" id="bn" v-model="bname">
                <input placeholder="Passwort" id="pw" type="password" v-model="pass">
                <button @click="login" :class="btn_class" :disabled="btn_disabled">
                    <span>Anmelden</span>
                </button>
                <div :class="meldung_class">
                    {{ meldung }}
                </div>
            </div>
        </div>

        <div v-else-if="schritt==2">
            <Shop />
        </div>

    </div>
</template>

<script>

import Cookies from "js-cookie";
import Shop from "../components/Shop.vue"

export default {
    
    created()
    {
        if(Cookies.get("logged_in") == "1")
            this.schritt = 2;
    },
    mounted()
    {
        if(this.schritt == 1)
            document.getElementById("bn").focus();
    },
    components:
    {
        Shop
    },
    data()
    {
        return {
            bname: "",
            pass: "",
            schritt: 1,
            meldung: "Ungültige Anmeldedaten! Bitte versuchen Sie erneut.",
            meldung_class: "meldung versteckt",
            btn_class: "",
            btn_text_op: 1,
            btn_disabled: false
        }
    },
    methods:
    {
        login()
        {
            this.btn_class = "loading";
            this.btn_disabled = true;


            fetch("http://localhost/login.php?benutzername=" + this.bname + "&passwort=" + this.pass)
            .then(antwort => antwort.text())
            .then(antwort =>
            {
                if(antwort == "1")
                {
                    Cookies.set("logged_in", "1");
                    this.schritt = 2;
                }
                else if(antwort == "0")
                {
                    this.meldung_class = "meldung";

                    setTimeout(() => { this.meldung_class = "meldung versteckt" }, 4000)
                }
                else
                {
                    // Server-Fehler
                }
            })
            .catch(() =>
            {

            })
            .finally(() =>
            {
                this.btn_class = "";
                this.btn_disabled = false;
            });
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
        transition: border 0.2s;
    }
    .loginContainer>input:focus
    {
        border-bottom: 2px solid crimson;
    }
    .loginContainer>button
    {
        position: relative;
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
    .loginContainer>button>span
    {
        transition: opacity 0.2s;
    }
    .loginContainer>button:disabled
    {
        background-color: rgb(199, 21, 57);
        cursor: auto;
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

    .loading>span
    {
        opacity: 0;
    }

    .loading::after
    {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        border: 4px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: btn-animation 1s ease infinite;
    }

@keyframes btn-animation
{
  from
  {
    transform: rotate(0turn);
  }

  to
  {
    transform: rotate(1turn);
  }
}

</style>