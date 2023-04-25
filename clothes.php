<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/closet/style/navbar.css" />
    <link rel="stylesheet" href="/closet/style/main.css" />
    <link rel="stylesheet" href="/closet/style/clothes.css" />
    <title>upload</title>
  </head>
  <body>
    <header class="header">
      <nav class="nav">
        <div class="nav__icon"><h1>CLOSET</h1></div>
        <ul class="nav__items">
          <li class="nav__item">
            <a href="/closet"><i class="fa fa-house"></i></a>
          </li>
          <li class="nav__item nav__item-active">
            <a href="/closet/clothes.php"><i class="fa-solid fa-shirt"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/upload.php"
              ><i class="fa-solid fa-cloud-arrow-up"></i
            ></a>
          </li>
          <li class="nav__item">
            <a href="/closet/setting.php"><i class="fa-solid fa-gear"></i></a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="main">
      <div class="modal__wrapper">
        <div class="modal">
          <div class="modal__icon" id="modalClose">
            <i class="fa-regular fa-circle-xmark"></i>
          </div>
          <div class="modal__set-name">
            <label for="set-name">Set name</label>
            <input type="text" name="set-name" id="modalInput">
          </div>
            <button class="button-alt" id="modalSubmit">Submit</button>
        </div>
      </div>
      <div class="container">
        <div class="clothes">
          <div class="clothes__category">
            <h2 class="clothes__title">No category</h2>
            <div class="clothes__items">
              <div class="clothes__item" id="id1">
                <div class="clothes__item-button">
                  <i class="fa-solid fa-check"></i>
                </div>
                <img src="/closet/photo-1600269452121-4f2416e55c28.webp" alt="item" />
              </div>
              <div class="clothes__item" id="id2">
                <div class="clothes__item-button">
                  <i class="fa-solid fa-check"></i>
                </div>
                <img src="/closet/photo-1600269452121-4f2416e55c28.webp" alt="item" />
              </div>
              <div class="clothes__item" id="id3">
                <div class="clothes__item-button">
                  <i class="fa-solid fa-check"></i>
                </div>
                <img src="/closet/photo-1600269452121-4f2416e55c28.webp" alt="item" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clothes__buttons">
        <button class="clothes__set-button button-alt" id="createSet">
          Create Set
        </button>
      </div>
    </main>
    <script
      src="https://kit.fontawesome.com/508d35aa0b.js"
      crossorigin="anonymous"
    ></script>
    <script>
      const items = document.getElementsByClassName("clothes__item");
      const itemsArray = Array.from(items);
      const buttons = document.querySelector(".clothes__buttons");
      let itemsID = [];
      const backDrop = document.querySelector(".modal__wrapper");
      const closeModal = document.getElementById("modalClose");
      const createSetBtn = document.getElementById("createSet") 
      const modalSubmit = document.getElementById("modalSubmit")
      const modalInput = document.getElementById("modalInput")
      let cateID = "";

      closeModal.addEventListener("click", () => {
        backDrop.classList.remove("modal__wrapper-active");
      });

      itemsArray.map((item) => {
        let clickCount = 0;
        item.addEventListener("click", () => {
          clickCount++;
          if (clickCount == 1) {
            if (!itemsID.includes(item.id)) {
              itemsID.push(item.id);
            }
            item.classList.add("clothes__item-active");
            buttons.classList.add("clothes__buttons-active");
          } else {
            item.classList.remove("clothes__item-active");
            clickCount = 0;
            itemsID.splice(itemsID.indexOf(item.id), 1);
            if (itemsID.length == 0) {
              buttons.classList.remove("clothes__buttons-active");
            }
          }
        });
      });

      createSetBtn.addEventListener('click', ()=> {
        backDrop.classList.add("modal__wrapper-active"); 
      })

      modalSubmit.addEventListener("click", ()=> {
        const data = {
          itemsID: itemsID,
          name: modalInput.value 
        }
        fetch("/closet/my-php.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        })
          .then((response) => response.text())
          .then((data) => console.log(data))
          .catch((error) => console.log(error));

        itemsID = []
        itemsArray.map((item) => {
          item.classList.remove("clothes__item-active");
        })
        backDrop.classList.remove("modal__wrapper-active")
        buttons.classList.remove("clothes__buttons-active");
      })

    </script>
    <footer></footer>
  </body>
</html>
