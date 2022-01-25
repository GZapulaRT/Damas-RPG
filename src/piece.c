#include "piece.h"

const int pieceRadius = 25;

void DrawPiece(int x, int y, int color)
{
	DrawCircle(x, y, pieceRadius, GetColor(color));
}