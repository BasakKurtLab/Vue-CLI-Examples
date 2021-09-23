<template>
    <div class="con">
        <div class="produkte">
            <h4>Produkte</h4>
            <div class="loading" :style="'display: ' + loading_disp"></div>
            <button v-for="p in produkte" :key="p.id" @click="addToCart(p)">
                {{ p.name }} - {{ p.preis }}
            </button>
            {{ fehler_text }}
        </div>

        <div class="warenkorb">
            <h4>Warenkorb</h4>
            <ul>
                <li v-for="p in warenkorb" :key="p.id">
                    {{ p.name }} - {{ p.preis }}
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
import Cookies from "js-cookie"; 

export default
{
    created()
    {
        if(Cookies.get("warenkorb"))
        {
            const liste = JSON.parse(Cookies.get("warenkorb"));

            for(let p of liste)
            {
                this.warenkorb.push(p);
            }
        }

        fetch("http://localhost/products.php")
        .then(response => response.json())
        .then(response =>
        {
            for(let p of response)
            {
                this.produkte.push(p);
            }
        })
        .catch(() =>
        {
            this.fehler_text = "Fehler!"
        })
        .finally(() =>
        {
            this.loading_disp = "none";
        });
    },
    data()
    {
        return {
            produkte: [],
            warenkorb: [],
            loading_disp: "block",
            fehler_text: ""
        }
    },
    methods:
    {
        addToCart(produkt)
        {
            this.warenkorb.push(produkt);
            Cookies.set("warenkorb", JSON.stringify(this.warenkorb));
        }
    }
}

</script>

<style scoped>

    .con
    {
        display: flex;
    }
    .con>div
    {
        width:50%;
    }

    .produkte>button
    {
        margin: 10px;
    }

    .con ul
    {
        text-align: left;
    }

    .loading
    {
        position: relative;
        margin-top: 10px;
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
        border-top-color: crimson;
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