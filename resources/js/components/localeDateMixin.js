export default {
    computed: {
        localeDate() {
            var options = {year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
            return (new Date()).toLocaleDateString('en-US', options);
        },
    }
}