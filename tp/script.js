document.addEventListener("DOMContentLoaded", function() {
    // Charger le contenu du fichier Python
    fetch('fonc_fichier.py') // Remplacez par le chemin vers votre fichier Python
        .then(response => response.text())
        .then(data => {
            // Afficher le contenu du fichier dans l'élément HTML
            document.getElementById('python-code').innerHTML = '<pre><code class="language-python">' + data + '</code></pre>';
            // Mettre à jour la coloration syntaxique avec Prism.js
            Prism.highlightAll();
        })
        .catch(error => {
            console.error('Erreur de chargement du fichier Python :', error);
            document.getElementById('python-code').textContent = 'Erreur de chargement du fichier Python.';
        });
});