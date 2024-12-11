const loadingOverlay = document.getElementById("loader"); // get the element with the id "loader"

const loader = {
    show: () => {
        if (loadingOverlay) {
            loadingOverlay.classList.remove("hidden"); // Remove hidden class
        }
    },

    hide: () => {
        if (loadingOverlay) {
            loadingOverlay.classList.add("hidden"); // Add hidden class
        }
    },
};

export default loader;
