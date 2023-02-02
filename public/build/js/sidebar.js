const bookingsBtn = document.querySelector("a[href='#booking-tb']");
const customersBtn = document.querySelector("a[href='#customers-tb']");
const addRoomsBtn = document.querySelector("a[href='#rooms-tb']");

const bookings = document.getElementById("booking-tb");
const customers = document.getElementById("customers-tb");
const addRooms = document.getElementById("rooms-tb");

// Mostrar bookings por defecto
bookings.style.display = "block";

// Esconder customers y addRooms
customers.style.display = "none";
addRooms.style.display = "none";

bookingsBtn.addEventListener("click", function() {
    bookings.style.display = "block";
    customers.style.display = "none";
    addRooms.style.display = "none";

    bookingsBtn.classList.add("active-nav");
    customersBtn.classList.remove("active-nav");
    addRoomsBtn.classList.remove("active-nav");
});

customersBtn.addEventListener("click", function() {
    bookings.style.display = "none";
    customers.style.display = "block";
    addRooms.style.display = "none";

    bookingsBtn.classList.remove("active-nav");
    customersBtn.classList.add("active-nav");
    addRoomsBtn.classList.remove("active-nav");
});

addRoomsBtn.addEventListener("click", function() {
    bookings.style.display = "none";
    customers.style.display = "none";
    addRooms.style.display = "block";

    bookingsBtn.classList.remove("active-nav");
    customersBtn.classList.remove("active-nav");
    addRoomsBtn.classList.add("active-nav");
});
