#include "raylib.h"
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>

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

        if(IsMouseButtonDown(MOUSE_LEFT_BUTTON)){
            Tile* cursorTile = GetCursorTile(board);
            
            if(selectedTile != NULL) selectedTile->selected = false;

            if(cursorTile != NULL){
                cursorTile->selected = true;
            }
            
            selectedTile = cursorTile;
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