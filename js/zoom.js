let image = document.getElementById('image');/*.setAttribute("class","ZoomIn/Out") pour changer de classe => modif dans un css*/
      function ZoomIn() {
         let width = image.clientWidth;
         let height = image.clientHeight;
         image.style.width = (width + 50) + "px";
         image.style.height = (height + 50) + "px";
      }
      function ZoomOut() {
         let width = image.clientWidth;
         let height = image.clientHeight;
         image.style.width = (width - 50) + "px";
         image.style.height = (height - 50) + "px";
      }

/* dans le html : <h3>Using the <i> height and width property </i> of images to add zoom in and zoom out features in images using JavaScript </h3>
   <img src ="https://www.tutorialspoint.com/images/trending_categories.svg" height = "500px" width = "500px" alt = "sample image" id = "image"> <br> <br>
   <button onclick = "ZoomIn()"> Zoom IN </button>
   <button onclick = "ZoomOut()"> Zoom Out </button>
   
   https://www.tutorialspoint.com/how-to-zoom-in-and-zoom-out-images-using-javascript
   je comprends ce qu'il fait mais ya peut-être plus efficace que rajouter deux boutons pour zoomer
   - oui, on peut notamment essayer de faire en sorte que le "bouton" soit la photo elle-même je pense
   et aussi il y a vraiment 50000 manières de créer des zooms donc bon va falloir en tester pleins jusqu'à trouver celle qu'on veux
   
   https://stackoverflow.com/questions/10464038/imitate-browser-zoom-with-javascript autre lien qui peut servir
   */