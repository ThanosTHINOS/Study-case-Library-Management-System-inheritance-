<?php

// Base class for all books
class Book {
    public $title;
    public $author;
    public $publicationYear;

    // Constructor to set the values when creating a book
    public function __construct($title, $author, $publicationYear) {
        // Check if title and author length is valid
        if (strlen($title) > 100) {
            throw new Exception("Title must be at most 100 characters.");
        }
        if (strlen($author) > 100) {
            throw new Exception("Author name must be at most 100 characters.");
        }

        // Check if publication year is valid
        if ($publicationYear < 1500 || $publicationYear > 2024) {
            throw new Exception("Publication year must be between 1500 and 2024.");
        }

        $this->title = $title;
        $this->author = $author;
        $this->publicationYear = $publicationYear;
    }

    // Function to get details of a book
    public function getDetails() {
        return "<span style='color:red; font-weight:bold;'>Title:</span> " . $this->title . 
               ", <span style='color:blue; font-weight:bold;'>Author:</span> " . $this->author . 
               ", <span style='color:green; font-weight:bold;'>Year:</span> " . $this->publicationYear;
    }
}

// Class for eBooks, which extends the Book class
class EBook extends Book {
    public $fileSize;

    // Constructor for eBooks with additional file size property
    public function __construct($title, $author, $publicationYear, $fileSize) {
        parent::__construct($title, $author, $publicationYear);

        // Check if file size is valid
        if ($fileSize < 1 || $fileSize > 100) {
            throw new Exception("File size must be between 1 and 100 MB.");
        }

        $this->fileSize = $fileSize;
    }

    // Override the getDetails function to include file size
    public function getDetails() {
        return parent::getDetails() . ", <span style='color:#e6005c; font-weight:bold;'>File Size:</span> " . $this->fileSize . "MB";
    }
}

// Class for PrintedBooks, which extends the Book class
class PrintedBook extends Book {
    public $numberOfPages;

    // Constructor for PrintedBooks with additional pages property
    public function __construct($title, $author, $publicationYear, $numberOfPages) {
        parent::__construct($title, $author, $publicationYear);

        // Assuming no specific validation for number of pages, but you can add a similar check if needed.
        $this->numberOfPages = $numberOfPages;
    }

    // Override the getDetails function to include number of pages
    public function getDetails() {
        return parent::getDetails() . ", <span style='color:#800080; font-weight:bold;'>Pages:</span> " . $this->numberOfPages;
    }
}

// Creating an array to store the books
$books = [];

try {
    // Example input (this would normally be dynamic in a real app)
    $books[] = new EBook("The Pragmatic Programmer", "Andrew Hunt", 1999, 100);
    $books[] = new PrintedBook("Clean Code", "Robert C. Martin", 2008, 464);
    $books[] = new EBook("You Don't Know JS", "Kyle Simpson", 2015, 2);

    // Adding more books
    $books[] = new PrintedBook("The Mythical Man-Month", "Frederick P. Brooks", 1975, 322);
    $books[] = new EBook("Head First Design Patterns", "Eric Freeman", 2004, 7);
    $books[] = new PrintedBook("Refactoring", "Martin Fowler", 1999, 431);
    $books[] = new EBook("The Art of Computer Programming", "Donald Knuth", 1968, 3);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

// Example queries (in a real app, this would come from user input)
$queryIndices = [1, 2, 3, 4, 5, 6, 7];

// Loop through the queries and display the details of the books
foreach ($queryIndices as $index) {
    // Subtracting 1 because arrays are 0-based in PHP
    echo $books[$index - 1]->getDetails() . "<br>";
}

?>
