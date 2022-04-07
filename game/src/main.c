#include "raylib.h"
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <math.h>

//Object Inclusion
#include "board.h"
#include "piece.h"

int main(void)
{
    // Initialization
    //--------------------------------------------------------------------------------------
    const int screenWidth = 920;
    const int screenHeight = 750;

    Tile* selectedTile = NULL;

    int playerTurn = 0;

    Board board = CreateLogicBoard();

    InitWindow(screenWidth, screenHeight, "Damas");

    SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
    //--------------------------------------------------------------------------------------

    // Main game loop
    while (!WindowShouldClose())    // Detect window close button or ESC key
    {
        // Update
        //----------------------------------------------------------------------------------
        // TODO: Update your variables here
        //----------------------------------------------------------------------------------

        // Draw
        //----------------------------------------------------------------------------------
        BeginDrawing();

            	ClearBackground(RAYWHITE);

                UpdateBasePos(&board);
                
            	DrawBoard(board);

        EndDrawing();

        if(IsMouseButtonPressed(MOUSE_LEFT_BUTTON) && selectedTile){
            Tile* cursorTile = GetCursorTile(board);
            
            // Lógica de Transferência de Peça/Desseleção de Tile
            if(selectedTile) 
            {
                if(cursorTile)
                    if(
                        (cursorTile->x + cursorTile->y)%2 && //Se a tile for válida, 
                        cursorTile->piece == NULL && // Sem peça,
                        (abs(cursorTile->x - selectedTile->x) <= selectedTile->piece->Mov && 
                        abs(cursorTile->y - selectedTile->y) <= selectedTile->piece->Mov) // E dentro dos parametros de movimento da peça
                      ) 
                    {
                        cursorTile->piece = selectedTile->piece; // transfere a peça
                        selectedTile->piece = NULL;

                        playerTurn = !playerTurn;   // passa a rodada
                    }
                
                selectedTile->selected = false; //desseleciona a tile
                selectedTile = NULL;    // Tira endereço da Selected Tile
            }
        }

        else if(IsMouseButtonPressed(MOUSE_LEFT_BUTTON)){
            Tile* cursorTile = GetCursorTile(board);

            // Lógica de Seleção de Tile
            if(cursorTile && cursorTile->piece && playerTurn == cursorTile->piece->Owner){
                cursorTile->selected = true;

                selectedTile = cursorTile;
            }
            
        }

        if(IsMouseButtonPressed(MOUSE_BUTTON_RIGHT) && selectedTile){

            // Lógica de Desseleção de Tile via botão direito do mouse

            selectedTile->selected = false;
            selectedTile = NULL;
        }


        //----------------------------------------------------------------------------------
    }

    // De-Initialization
    //--------------------------------------------------------------------------------------
    ClearBoard(board);
    CloseWindow();        // Close window and OpenGL context
    //--------------------------------------------------------------------------------------

    return 0;
}