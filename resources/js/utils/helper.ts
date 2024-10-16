export function getRomanNumber(num: number): string {
    
    const roman: { [key: number]: string } = {
        1: "I",
        4: "IV",
        5: "V",
        9: "IX",
        10: "X",
        40: "XL",
        50: "L",
        90: "XC",
        100: "C",
        400: "CD",
        500: "D",
        900: "CM",
        1000: "M",
    };

    let result = "";

    for (const key of Object.keys(roman).reverse()) {
        const intKey = parseInt(key);
        while (num >= intKey) {
            result += roman[intKey];
            num -= intKey;
        }
    }

    return result;
}

export function getNumberWithOrdinal(n: number): string {
    const s = ["th", "st", "nd", "rd"];
    const v = n % 100;
    return n + (s[(v - 20) % 10] || s[v] || s[0]);
}