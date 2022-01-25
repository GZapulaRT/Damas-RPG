#ifndef BOARD_H
#define BOARD_H

#include "raylib.h"
#include "piece.h"
#include <stdlib.h>
#include <stdio.h>

extern const int tileSize;
extern const int boardSize;

typedef struct Tile{
	// char tileType[5];
	struct Piece* piece;
}Tile;

typedef struct Board{
	Tile** board;
}Board;

Board CreateLogicBoard();
void CreateVisualBoard(Board);
void ClearBoard(Board);
Piece PieceInfo();

#endif