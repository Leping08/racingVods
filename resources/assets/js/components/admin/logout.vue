<template>
    <div>

    </div>
</template>

<script>
    export default {
        created() {
            window.setAccessToken('');
            this.$store.dispatch('authCheck');
            this.$router.push('/login')
        },
    }
</script>