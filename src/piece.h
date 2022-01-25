#ifndef PIECE_H
#define PIECE_H

#include "raylib.h"

extern const int pieceRadius;

typedef struct Piece{
	int HP;
	int Mov;
	int Atk;
	int Owner;
}Piece;

void DrawPiece();

#endif