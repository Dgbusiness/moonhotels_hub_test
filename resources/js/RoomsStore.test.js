import { dateFormatter } from "./helpers/DateFormatter";

const testDate = new Date("December 17, 1995 03:24:00");

describe("Test for Vue Helpers", () => {
    test("Change Date Format to dd-mm-yyyy", () => {
        expect(dateFormatter(testDate)).toBe("17-12-1995");
    });
});
