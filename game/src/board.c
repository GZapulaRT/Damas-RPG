#include "board.h"
#include <math.h>
#include <raylib.h>

const int tileSize = 55;
const int boardSize = 12;
	// Tratar sempre com valores pares de tabuleiro, caso contrário uma linha pode ter mais peças.

Board CreateLogicBoard()
{
	// Board Logic Creation
	//---------------------------------------------------------------------------------
	Board logicBoard;
	logicBoard.board = malloc(sizeof(Tile*)*boardSize);

	for(int i = 0; i < boardSize; i++)
	{
		logicBoard.board[i] = malloc(sizeof(Tile)*boardSize);


		// Piece and Piece's owner Definition
		//---------------------------------------------------------------------------
		for(int j = 0; j < boardSize; j++)
		{
			logicBoard.board[i][j].selected = false;
			logicBoard.board[i][j].x = i;
			logicBoard.board[i][j].y = j;
			if((i+j)%2)
			{
				if(j < 3)
				{
					logicBoard.board[i][j].piece = malloc(sizeof(Piece));
					logicBoard.board[i][j].piece->Owner = 0;
					logicBoard.board[i][j].piece->HP = 1;
					logicBoard.board[i][j].piece->Atk = 1;
					logicBoard.board[i][j].piece->Mov = 1;
				}
				else if(j > boardSize - 4)
				{
					logicBoard.board[i][j].piece = malloc(sizeof(Piece));
					logicBoard.board[i][j].piece->Owner = 1;
					logicBoard.board[i][j].piece->HP = 1;
					logicBoard.board[i][j].piece->Atk = 1;
					logicBoard.board[i][j].piece->Mov = 2;
				}
				else
				{
					logicBoard.board[i][j].piece = NULL;
				}
			}
		}
	}

	return logicBoard;
}

void DrawBoard(Board logicBoard)
{
	// Board Visual Creation
	//---------------------------------------------------------------------------------
	for(int i = 0; i < boardSize; i++)
    	for(int j = 0; j < boardSize; j++)
    	{	
    		Color color;

			if(logicBoard.board[i][j].selected){
				color = RED;
			}
			else{
				color = (i+j)%2?GetColor(0Xc1d8f5ff):GetColor(0X13012bff);
			}

    		DrawRectangle(logicBoard.basePosX+i*tileSize, logicBoard.basePosY+j*tileSize, tileSize, tileSize, color);

    		if(logicBoard.board[i][j].piece != NULL)
    		{
    			if(logicBoard.board[i][j].piece->Owner)
	    		{
	    			DrawPiece(logicBoard.basePosX+i*tileSize+tileSize/2, logicBoard.basePosY+j*tileSize+tileSize/2, 0x619146ff);
	    		}
	    		else
	    		{
	    			DrawPiece(logicBoard.basePosX+i*tileSize+tileSize/2, logicBoard.basePosY+j*tileSize+tileSize/2, 0x9c2f2fff);
	    		}
    		}
    	}	
}

void ClearBoard(Board logicBoard)
{
	for(int i = 0; i < boardSize; i++)
	{
		for(int j = 0; j < boardSize; j++)
		{
			free(logicBoard.board[i][j].piece);
		}
		free(logicBoard.board[i]);
	}

	free(logicBoard.board);
}

Tile* GetCursorTile(Board board){

	int mouseX = GetMouseX();
	int mouseY = GetMouseY();

	int xIndex = (mouseX - board.basePosX) < 0 ? -1 : (mouseX - board.basePosX)/tileSize;
	int yIndex = (mouseY - board.basePosY) < 0 ? -1 : (mouseY - board.basePosY)/tileSize;

	//Se a posição relativa do mouse ao tabuleiro for negativa, o index vira 0

	if(xIndex >= 0 && xIndex < boardSize && yIndex >= 0 && yIndex < boardSize){
		return &(board.board[xIndex][yIndex]);
	}
	else{
		return NULL;
	}

}

void UpdateBasePos(Board *board){
	board->basePosX = GetScreenWidth()/2 - boardSize/2*tileSize;
	board->basePosY = GetScreenHeight()/2 - boardSize/2*tileSize;
}