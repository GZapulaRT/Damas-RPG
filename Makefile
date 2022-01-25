test: board.o piece.o
	gcc src/main.c bin/board.o bin/piece.o -o bin/testRL -std=c99 -I. -I../src -L. -L../release/linux -lraylib -lGL -lm -ldl -pthread

board.o:
	gcc -c src/board.c -o bin/board.o
	
piece.o:
	gcc -c src/piece.c -o bin/piece.o

runTest: test
	bin/testRL