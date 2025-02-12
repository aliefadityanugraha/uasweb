// Objek untuk keranjang belanja
const cart = {
    items: [],

    getItems: function() {
        return this.items;
    },

    addItem: function(product) {
        // Cek apakah produk sudah ada di keranjang
        const existingItem = this.items.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            this.items.push({ ...product, quantity: 1 });
        }
        this.updateCartUI();
    },

    getTotal: function() {
        return this.items.reduce((total, item) => total + item.price * item.quantity, 0);
    },

    updateCartUI: function() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        
        cartItemsContainer.innerHTML = '';
        
        this.items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.textContent = `${item.name} x${item.quantity} - Rp ${item.price * item.quantity}`;
            cartItemsContainer.appendChild(itemElement);
        });
        
        cartTotal.textContent = this.getTotal().toLocaleString('id-ID');
    }
};

const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
addToCartButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();  // Mencegah aksi default dari link

        const product = {
            id: button.getAttribute('data-product-id'),
            name: button.getAttribute('data-product-name'),
            price: parseInt(button.getAttribute('data-product-price')),
            image: button.getAttribute('data-product-image')
        };
        
        cart.addItem(product);
    });
});

// Event listener untuk checkout
// document.getElementById('checkout-button').addEventListener('click', () => {
//     alert('Melakukan checkout... Total: Rp ' + cart.getTotal().toLocaleString('id-ID'));
// });

// Event listener untuk checkout
document.getElementById('checkout-button').addEventListener('click', () => {
    const total = cart.getTotal();
    const orderData = {
        items: cart.getItems(),
        total: total
    };

    const form = document.createElement('form');
    form.action = '/uasweb/php/addOrder.php';
    form.method = 'POST';

    const itemsInput = document.createElement('input');
    itemsInput.type = 'hidden';
    itemsInput.name = 'items';
    itemsInput.value = JSON.stringify(orderData.items);
    form.appendChild(itemsInput);

    const totalInput = document.createElement('input');
    totalInput.type = 'hidden';
    totalInput.name = 'total';
    totalInput.value = total;
    form.appendChild(totalInput);

    document.body.appendChild(form);
    form.submit();
});


