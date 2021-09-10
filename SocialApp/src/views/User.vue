<template>
    <div class="wrapper">
        <div class="top">
            <Photo :bildquelle="bild" />
            <Title :username="$route.params.username" :fullname="fullname" />
        </div>
        
        <Posts />

    </div>
</template>

<script>

const users =
[
	{ id: 0, username: "max_muster25", fullname: "Max Mustermann", email: "user@domain.com", photo: "https://lh3.googleusercontent.com/proxy/56Rk6LMKIQw9ANSYhjZZ-1YLvATQN0jXIcrqCNc_eglwI6kfy5mNxj-5oUPcnLb-IyUR1-ljrTfx6kKvAkmjQ4VmCGZ9EQYO_wQE8PLWZM8vogfmK5-eA6hb-hHNhA"},
	{ id: 1, username: "digitale_k", fullname: "Digitale Karriere", email: "user@domain.com", photo: "https://lh3.googleusercontent.com/proxy/56Rk6LMKIQw9ANSYhjZZ-1YLvATQN0jXIcrqCNc_eglwI6kfy5mNxj-5oUPcnLb-IyUR1-ljrTfx6kKvAkmjQ4VmCGZ9EQYO_wQE8PLWZM8vogfmK5-eA6hb-hHNhA"},
	{ id: 2, username: "maria1992", fullname: "Maria Musterfrau", email: "user@domain.com", photo: "https://lh3.googleusercontent.com/proxy/56Rk6LMKIQw9ANSYhjZZ-1YLvATQN0jXIcrqCNc_eglwI6kfy5mNxj-5oUPcnLb-IyUR1-ljrTfx6kKvAkmjQ4VmCGZ9EQYO_wQE8PLWZM8vogfmK5-eA6hb-hHNhA"},
	{ id: 3, username: "theo_x", fullname: "Theo Müller", email: "user@domain.com", photo: "https://www.luxcom-mallorca.com/wp-content/uploads/2016/11/profile-silhouette-Gfiv7m-clipart.png"},
	{ id: 4, username: "helloworld", fullname: "Katrin Schmidt", email: "user@domain.com", photo: "https://lh3.googleusercontent.com/proxy/56Rk6LMKIQw9ANSYhjZZ-1YLvATQN0jXIcrqCNc_eglwI6kfy5mNxj-5oUPcnLb-IyUR1-ljrTfx6kKvAkmjQ4VmCGZ9EQYO_wQE8PLWZM8vogfmK5-eA6hb-hHNhA"},
	{ id: 5, username: "lustige_seite", fullname: "Keine Ahnung", email: "user@domain.com", photo: "https://lh3.googleusercontent.com/proxy/56Rk6LMKIQw9ANSYhjZZ-1YLvATQN0jXIcrqCNc_eglwI6kfy5mNxj-5oUPcnLb-IyUR1-ljrTfx6kKvAkmjQ4VmCGZ9EQYO_wQE8PLWZM8vogfmK5-eA6hb-hHNhA"},
]

import Photo from "../components/Profile/Photo.vue"
import Title from "../components/Profile/Title.vue"
import Posts from "../components/Profile/Posts.vue"


export default
{
    components:
    {
        Photo,
        Title,
        Posts
    },
    computed:
    {
        fullname()
        {
            const u = this.$route.params.username;

            for(let user of users)
            {
                if(user.username == u)
                {
                    return user.fullname;
                }
            }

            return "(user not found)";
        },
        //bild: function()
        bild()
        {
            const u = this.$route.params.username;

            for(let user of users)
            {
                if(user.username == u)
                {
                    return user.photo;
                }
            }

            return "";
        }
    },
    methods:
    {
    }
}
</script>

<style scoped>

.top
{
    display: flex;
    margin-bottom: 35px;
}

</style>