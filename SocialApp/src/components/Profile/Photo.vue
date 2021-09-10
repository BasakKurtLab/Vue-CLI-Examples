<template>
    <div :style="style">

    </div>
</template>

<style scoped>
div
{
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 35px;
    background-size: cover;
    background-position: center;
}
</style>

<script>
export default
{
    props:
    {
        bildquelle: String
    },
    computed:
    {
        style()
        {
            if(this.bildquelle != "")
            {
                return "background-image: url(" + this.bildquelle + ")";
            }

            return "";
        }
    }
}
</script>