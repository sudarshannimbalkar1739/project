cart = {};

function addToCart(id, name, price) {
    document.getElementById("cart").classList.remove("hidden");

    if (cart[id]) {
        cart[id].qty++;
    } else {
        cart[id] = { id, name, price, qty: 1 };
    }

    renderCart();
}

function changeQty(id, type) {
    if (!cart[id]) return;

    if (type === "plus") {
        cart[id].qty++;
    } else {
        cart[id].qty--;
        if (cart[id].qty <= 0) {
            delete cart[id];
        }
    }

    renderCart();
}

function renderCart() {

    let cartItems = document.getElementById("cartItems");
    let cartTotal = document.getElementById("cartTotal");
    let cartData = document.getElementById("cartData");

    if (!cartItems || !cartData) return;

    let total = 0;
    cartItems.innerHTML = "";
    let output = [];

    for (let id in cart) {

        let item = cart[id];
        let itemTotal = item.price * item.qty;
        total += itemTotal;

        output.push(item.id + "|" + item.name + "|" + item.price + "|" + item.qty);

        cartItems.innerHTML += `
            <div class="cart-item">
                <span>${item.name} (₹${item.price})</span>
                <span>
                    <button type="button" onclick="changeQty(${item.id}, 'minus')">−</button>
                    ${item.qty}
                    <button type="button" onclick="changeQty(${item.id}, 'plus')">+</button>
                </span>
            </div>
        `;
    }

    cartTotal.innerText = total;
    cartData.value = output.join(",");
}
