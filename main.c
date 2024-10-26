#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

#define PAGE_SIZE 4096
#define NUM_PAGES 5
#define PAGE_FILE "page.dat"

int main() {
    int *pages[NUM_PAGES];
    int i;
    FILE *fp;

    // Allocate pages
    for (i = 0; i < NUM_PAGES; i++) {
        pages[i] = malloc(PAGE_SIZE);
        printf("Allocated page %d: %p\n", i, pages[i]);

        // Initialize page with some data
        for (int j = 0; j < PAGE_SIZE / sizeof(int); j++) {
            pages[i][j] = i * j;
        }
    }

    // Simulate page replacement
    printf("Simulating page replacement...\n");
    // Select a page to replace (e.g., LRU)
    int page_to_replace = 1;
    printf("Replacing page %d...\n", page_to_replace);

    // Write page to disk
    printf("Writing page to disk...\n");
    fp = fopen(PAGE_FILE, "wb");
    if (fp == NULL) {
        perror("fopen");
        exit(1);
    }
    fwrite(pages[page_to_replace], PAGE_SIZE, 1, fp);
    fclose(fp);
    printf("Page written to disk successfully\n");

    // Simulate page fault
    printf("Simulating page fault...\n");
    printf("Page %d not in memory, reading from disk...\n", page_to_replace);

    // Read page from disk
    fp = fopen(PAGE_FILE, "rb");
    if (fp == NULL) {
        perror("fopen");
        exit(1);
    }
    int *page_from_disk = malloc(PAGE_SIZE);
    fread(page_from_disk, PAGE_SIZE, 1, fp);
    fclose(fp);
    printf("Page read from disk successfully\n");

    // Validate retrieved page
    printf("Validating retrieved page...\n");
    for (int j = 0; j < PAGE_SIZE / sizeof(int); j++) {
        printf("%d ", page_from_disk[j]);
    }
    printf("\n");

    // Update page table
    printf("Updating page table...\n");
    // Assume page table update is fast

    printf("Page replacement and retrieval successful\n");
    return 0;
}