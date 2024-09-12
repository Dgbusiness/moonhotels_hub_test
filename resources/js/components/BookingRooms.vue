<script setup>
import DatePicker from 'primevue/datepicker';
import { useListOfRooms } from '../store/RoomStore';
import { mapActions, mapStores } from 'pinia';

</script>

<template>
    <div class="max-w-sm mx-auto">
        <form class="flex flex-col">
            <h1 class="text-3xl font-bold underline mb-1">Looking for a Room?</h1>
            <label for="hotels" class="block mb-2 text-sm font-medium text-gray-900 text-white">Select your
                Hotel</label>
            <select id="hotels" v-model="request.hotelId" multiple
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <option value="hotelLegs">HotelLegs</option>
            </select>
            <div class="flex flex-row mb-2">
                <div class="flex flex-col items-center mr-1">
                    <label for="guests-input" class="block text-sm font-medium text-gray-900 text-white">Number of
                        Guests:</label>
                    <input type="number" v-model="request.numberOfGuests" min="1" id="guests-input"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="2" required />

                </div>
                <div class="flex flex-col items-center ml-1">
                    <label for="rooms-input" class="block text-sm font-medium text-gray-900 text-white">Number of
                        Rooms:</label>
                    <input type="number" v-model="request.numberOfRooms" id="rooms-input" min="1"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="1" required />
                </div>
            </div>
            <div class="card flex justify-center mb-2 w-full">
                <label for="dates" class="block text-sm font-medium text-gray-900 text-white">Number of
                    nights:</label>
                <DatePicker id="dates" v-model="request.dates" :minDate="new Date()" selectionMode="range"
                    :manualInput="false" dateFormat="dd-mm-yy" />
            </div>
            <button type="button" @click="search"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
        </form>
        <hr>
        <ul class="list-group">
            <li class="list-group-item" v-for="(item, index) in this.roomsListStore.rooms" :key="index">
                <div>
                    <h2>Rooms in {{ index }}</h2>
                    <ul>
                        <li v-for="room in item.rooms" :key="room.roomId">
                            <h3>Room {{ room.roomId }}</h3>
                            <ul>
                                <li v-for="rate in room.rates" :key="rate.mealPlanId">
                                    Meal Plan: {{ rate.mealPlanId }}
                                    <span v-if="rate.isCancellable"> (Cancellable)</span>
                                    <span v-else>(Non-Cancellable)</span>
                                    - Price: {{ rate.price }}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            request: { hotelId: '', numberOfGuests: '', numberOfRooms: '', dates: '', currency: 'EUR' },
        }
    },
    computed: {
        // note we are not passing an array, just one store after the other
        // each store will be accessible as its id + 'Store'
        ...mapStores(useListOfRooms),
    },
    methods: {
        ...mapActions(useListOfRooms, ['updateRooms']),
        search() {

            let request = this.request;
            request.checkIn = this.request.dates[0].toLocaleDateString("en-GB").replaceAll('/', '-')
            request.checkOut = this.request.dates[1].toLocaleDateString("en-GB").replaceAll('/', '-')

            this.request = { hotelId: '', numberOfGuests: '', numberOfRooms: '', dates: '', currency: 'EUR' };
            axios.post('/api/search', request)
                .then((res) => {
                    this.updateRooms(res.data)
                })
        },
    }
}
</script>
