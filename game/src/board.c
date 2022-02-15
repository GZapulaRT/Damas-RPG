#include "board.h"

const int tileSize = 55;
const int boardSize = 12;

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
			if((i+j)%2)
			{
				if(j < 3)
				{
					logicBoard.board[i][j].piece = malloc(sizeof(Piece));
					logicBoard.board[i][j].piece->Owner = 0;
				}
				else if(j > boardSize - 4)
				{
					logicBoard.board[i][j].piece = malloc(sizeof(Piece));
					logicBoard.board[i][j].piece->Owner = 1;	
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

void CreateVisualBoard(Board logicBoard)
{
	// Board Visual Creation
	//---------------------------------------------------------------------------------
	for(int i = 0; i < boardSize; i++)
    	for(int j = 0; j < boardSize; j++)
    	{	
    		int basePosX = GetScreenWidth()/2 - boardSize/2*tileSize;
    		int basePosY = GetScreenHeight()/2 - boardSize/2*tileSize;
    		DrawRectangle(basePosX+i*tileSize, basePosY+j*tileSize, tileSize, tileSize, (i+j)%2?GetColor(0Xc1d8f5ff):GetColor(0X13012bff));

    		if(logicBoard.board[i][j].piece != NULL)
    		{
    			if(logicBoard.board[i][j].piece->Owner)
	    		{
	    			DrawPiece(basePosX+i*tileSize+tileSize/2, basePosY+j*tileSize+tileSize/2, 0x619146ff);
	    		}
	    		else
	    		{
	    			DrawPiece(basePosX+i*tileSize+tileSize/2, basePosY+j*tileSize+tileSize/2, 0x9c2f2fff);
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
