<?php
class Book {
    private $code_book;
    private $name;
    private $qty;

    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name;
        $this->setQty($qty);
    }

    private function setCodeBook($code_book) {
        if (!preg_match('/^[A-Z]{2}\d{2}$/', $code_book)) {
            throw new InvalidArgumentException("Error: Format kode buku harus seperti 'BB00' (2 huruf kapital diikuti dengan 2 digit.)");
        }
        $this->code_book = $code_book;
    }

    private function setQty($qty) {
        if (!is_int($qty) || $qty <= 0) {
            throw new InvalidArgumentException("Error: Quantity harus berjumlah psoitif.");
        }
        $this->qty = $qty;
    }

    public function getCodeBook() {
        return $this->code_book;
    }

    public function getQty() {
        return $this->qty;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}

// Contoh:
try {
    $book = new Book("AB12", "PHP Programming", 10);
    echo "Book Code: " . $book->getCodeBook() . "\n";
    echo "Book Name: " . $book->getName() . "\n";
    echo "Quantity: " . $book->getQty() . "\n";
    
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
?>