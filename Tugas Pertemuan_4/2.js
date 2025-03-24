const calculator = (operator, ...numbers) => {
    switch (operator) {
        case '+':
            return numbers.reduce((acc, num) => acc + num, 0);
        case '-':
            return numbers.reduce((acc, num) => acc - num);
        case '*':
            return numbers.reduce((acc, num) => acc * num, 1);
        case '/':
            return numbers.reduce((acc, num) => acc / num);
        case '%':
            return numbers.reduce((acc, num) => acc % num);
        default:
            return "Operator tidak valid";
    }
};

console.log(calculator('+', 1, 2, 3, 4)); // Output: 10
console.log(calculator('-', 10, 3, 2));  // Output: 5
console.log(calculator('*', 2, 3, 4));   // Output: 24
console.log(calculator('/', 100, 2, 5)); // Output: 10
console.log(calculator('%', 10, 3));     // Output: 1
