import { defineStore } from "pinia";

export const useListOfRooms = defineStore("roomsList", {
    state: () => ({ rooms: []}),
    actions: {
        updateRooms(rooms) {
            this.rooms = rooms
        },
    },
});
